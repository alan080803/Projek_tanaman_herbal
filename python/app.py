"""
Flask API for Herbal Plant Classification
Pipeline:
1. YOLOv8/YOLO26 Object Detection: Verifies that the uploaded image contains a leaf ('leaf' class, nc: 1).
2. MobileNetV2 Classification: If a leaf is detected, classifies the plant into one of 13 Indonesian herbal plant species.
If no leaf is detected, returns an informative message without proceeding to the classifier.
"""

import os
import io
import json
import numpy as np
from PIL import Image
from flask import Flask, request, jsonify
from flask_cors import CORS
import tensorflow as tf
from ultralytics import YOLO

# Initialize Flask app
app = Flask(__name__)
CORS(app)  # Enable CORS for Laravel integration

# Paths & Configuration
BASE_DIR = os.path.dirname(os.path.abspath(__file__))
CNN_MODEL_PATH = os.path.join(BASE_DIR, 'daun_savedmodel')

# Check possible locations for YOLO best weights
YOLO_MODEL_PATH = os.environ.get('YOLO_MODEL_PATH')
if not YOLO_MODEL_PATH or not os.path.exists(YOLO_MODEL_PATH):
    candidate_paths = [
        os.path.join(BASE_DIR, 'best.pt'),
        os.path.join(BASE_DIR, 'runs', 'detect', 'train_ep50', 'weights', 'best.pt'),
    ]
    for p in candidate_paths:
        if os.path.exists(p):
            YOLO_MODEL_PATH = p
            break
    if not YOLO_MODEL_PATH:
        YOLO_MODEL_PATH = candidate_paths[0]

IMG_SIZE = (224, 224)
MAX_FILE_SIZE = 10 * 1024 * 1024  # 10MB
YOLO_CONF_THRESHOLD = float(os.environ.get('YOLO_CONF_THRESHOLD', 0.25))

# Class names matching the 13 plants in database (order from model training)
CLASS_NAMES = [
    'Lidah Buaya',
    'Belimbing Botol',
    'Brotowali',
    'Cocor Bebek',
    'Daun Pariya',
    'Daun Sirih',
    'Jahe',
    'Jambu Biji',
    'Kunyit',
    'Mayana',
    'Pepaya',
    'Pohon Jarak',
    'Sambiloto'
]

# Global model variables
cnn_model = None
yolo_model = None


def load_models():
    """Load both YOLO and MobileNetV2 models"""
    global cnn_model, yolo_model
    yolo_loaded = False
    cnn_loaded = False

    # 1. Load YOLO model
    try:
        print(f"Loading YOLO model from {YOLO_MODEL_PATH}...")
        yolo_model = YOLO(YOLO_MODEL_PATH)
        print(f"YOLO model loaded successfully! Classes: {yolo_model.names}")
        yolo_loaded = True
    except Exception as e:
        print(f"Error loading YOLO model: {str(e)}")

    # 2. Load MobileNetV2 SavedModel
    try:
        print(f"Loading MobileNetV2 model from {CNN_MODEL_PATH}...")
        cnn_model = tf.saved_model.load(CNN_MODEL_PATH)
        print("MobileNetV2 model loaded successfully!")
        cnn_loaded = True
    except Exception as e:
        print(f"Error loading MobileNetV2 model: {str(e)}")

    return yolo_loaded and cnn_loaded


def detect_leaf_with_yolo(pil_img):
    """
    Run YOLO inference to detect leaf objects in the image.
    nc: 1, names: ['leaf']
    Returns:
        tuple (leaf_detected: bool, leaf_count: int, max_conf: float, detections: list)
    """
    try:
        results = yolo_model.predict(source=pil_img, conf=YOLO_CONF_THRESHOLD, verbose=False)
        boxes = results[0].boxes if len(results) > 0 else None

        detected_leaves = []
        max_conf = 0.0

        if boxes is not None and len(boxes) > 0:
            for box in boxes:
                cls_id = int(box.cls[0].item())
                conf = float(box.conf[0].item())
                cls_name = yolo_model.names.get(cls_id, 'leaf')

                # Check if detected object is leaf (cls 0 / name 'leaf')
                if cls_name == 'leaf' or cls_id == 0:
                    if conf > max_conf:
                        max_conf = conf

                    coords = [round(float(c), 2) for c in box.xyxy[0].tolist()]
                    detected_leaves.append({
                        'class_id': cls_id,
                        'class_name': cls_name,
                        'confidence': round(conf, 4),
                        'confidence_percentage': round(conf * 100, 2),
                        'box': coords
                    })

        leaf_count = len(detected_leaves)
        leaf_detected = leaf_count > 0

        return leaf_detected, leaf_count, max_conf, detected_leaves
    except Exception as e:
        print(f"YOLO detection error: {str(e)}")
        # In case of YOLO runtime failure, propagate exception
        raise RuntimeError(f"Error during YOLO leaf detection: {str(e)}")


def preprocess_image_for_cnn(pil_img):
    """
    Preprocess PIL Image for MobileNetV2 model prediction
    - Resize to 224x224
    - Normalize to 0-1 range
    - Add batch dimension
    """
    try:
        # Resize to model input size
        img_resized = pil_img.resize(IMG_SIZE)

        # Convert to numpy array
        img_array = np.array(img_resized, dtype=np.float32)

        # Normalize to 0-1 range (same as training)
        img_array = img_array / 255.0

        # Add batch dimension
        img_array = np.expand_dims(img_array, axis=0)

        return img_array
    except Exception as e:
        raise ValueError(f"Error preprocessing image for CNN: {str(e)}")


def get_cnn_prediction(img_array):
    """
    Get prediction from MobileNetV2 model
    Returns class probabilities (numpy array)
    """
    try:
        # Get the inference function
        infer = cnn_model.signatures['serving_default']

        # Convert to tensor
        input_tensor = tf.convert_to_tensor(img_array, dtype=tf.float32)

        # Get prediction
        predictions = infer(input_tensor)

        # Extract output (key might vary, try common names)
        if 'output_0' in predictions:
            output = predictions['output_0'].numpy()
        elif 'dense' in predictions:
            output = predictions['dense'].numpy()
        else:
            # Get first output
            output = list(predictions.values())[0].numpy()

        return output[0]  # Remove batch dimension
    except Exception as e:
        raise RuntimeError(f"Error during CNN prediction: {str(e)}")


@app.route('/api/health', methods=['GET'])
def health_check():
    """Health check endpoint with status of both models"""
    return jsonify({
        'status': 'healthy',
        'yolo_loaded': yolo_model is not None,
        'mobilenet_loaded': cnn_model is not None,
        'yolo_classes': list(yolo_model.names.values()) if yolo_model else [],
        'cnn_classes_count': len(CLASS_NAMES),
        'version': '2.0.0'
    })


@app.route('/api/predict', methods=['POST'])
def predict():
    """
    Main prediction endpoint with 2-stage verification:
    1. YOLO checks if a leaf exists in the image.
    2. If leaf found -> MobileNetV2 classifies the herbal plant.
    3. If no leaf found -> Immediately returns 'leaf_detected': False with explanation.
    """
    try:
        # Check if both models are loaded
        if yolo_model is None or cnn_model is None:
            return jsonify({
                'success': False,
                'error': 'Satu atau lebih model ML belum berhasil dimuat pada server'
            }), 500

        # Check if image file is present
        if 'image' not in request.files:
            return jsonify({
                'success': False,
                'error': 'No image file provided'
            }), 400

        file = request.files['image']

        # Check if file is empty
        if file.filename == '':
            return jsonify({
                'success': False,
                'error': 'Empty filename'
            }), 400

        # Read image bytes
        image_bytes = file.read()

        # Check file size
        if len(image_bytes) > MAX_FILE_SIZE:
            return jsonify({
                'success': False,
                'error': f'File size exceeds {MAX_FILE_SIZE/1024/1024}MB limit'
            }), 400

        # Open image using PIL
        try:
            img = Image.open(io.BytesIO(image_bytes))
            if img.mode != 'RGB':
                img = img.convert('RGB')
        except Exception as e:
            return jsonify({
                'success': False,
                'error': f'Invalid image format: {str(e)}'
            }), 400

        # ==========================================
        # TAHAP 1: Deteksi Daun Menggunakan YOLO
        # ==========================================
        try:
            leaf_detected, leaf_count, max_conf, yolo_detections = detect_leaf_with_yolo(img)
        except RuntimeError as e:
            return jsonify({
                'success': False,
                'error': str(e)
            }), 500

        yolo_info = {
            'leaf_detected': leaf_detected,
            'leaf_count': leaf_count,
            'max_confidence': round(max_conf, 4),
            'max_confidence_percentage': round(max_conf * 100, 2),
            'detections': yolo_detections
        }

        # Jika TIDAK ADA daun terdeteksi:
        if not leaf_detected:
            return jsonify({
                'success': True,
                'leaf_detected': False,
                'message': 'Tidak ada daun yang terdeteksi di dalam gambar. Klasifikasi jenis tanaman herbal tidak dilanjutkan.',
                'yolo_result': yolo_info,
                'predictions': [],
                'top_prediction': None
            }), 200

        # ==========================================
        # TAHAP 2: Klasifikasi Menggunakan MobileNetV2
        # (Hanya dijalankan jika daun terdeteksi)
        # ==========================================
        try:
            img_array = preprocess_image_for_cnn(img)
            predictions = get_cnn_prediction(img_array)
        except (ValueError, RuntimeError) as e:
            return jsonify({
                'success': False,
                'error': str(e)
            }), 500

        # Ambil top 3 prediksi MobileNetV2
        top_indices = np.argsort(predictions)[-3:][::-1]

        results = []
        for idx in top_indices:
            results.append({
                'plant_name': CLASS_NAMES[idx],
                'confidence': float(predictions[idx]),
                'confidence_percentage': float(predictions[idx] * 100)
            })

        response = {
            'success': True,
            'leaf_detected': True,
            'message': f'Daun berhasil terdeteksi ({leaf_count} objek). Klasifikasi tanaman berhasil dilakukan.',
            'yolo_result': yolo_info,
            'predictions': results,
            'top_prediction': {
                'plant_name': CLASS_NAMES[top_indices[0]],
                'confidence': float(predictions[top_indices[0]]),
                'confidence_percentage': float(predictions[top_indices[0]] * 100)
            }
        }

        return jsonify(response), 200

    except Exception as e:
        return jsonify({
            'success': False,
            'error': f'Unexpected error: {str(e)}'
        }), 500


@app.route('/api/classes', methods=['GET'])
def get_classes():
    """Get list of all plant classes"""
    return jsonify({
        'success': True,
        'classes': CLASS_NAMES,
        'total': len(CLASS_NAMES)
    })


@app.errorhandler(404)
def not_found(error):
    """Handle 404 errors"""
    return jsonify({
        'success': False,
        'error': 'Endpoint not found'
    }), 404


@app.errorhandler(500)
def internal_error(error):
    """Handle 500 errors"""
    return jsonify({
        'success': False,
        'error': 'Internal server error'
    }), 500


if __name__ == '__main__':
    # Load both models on startup
    if not load_models():
        print("Failed to load required models. Exiting...")
        exit(1)

    # Run Flask app
    print("Starting Flask API server with YOLO + MobileNetV2 pipeline...")
    print(f"YOLO Model: {YOLO_MODEL_PATH}")
    print(f"MobileNet Model: {CNN_MODEL_PATH}")
    print(f"Available herbal plant classes: {len(CLASS_NAMES)}")
    app.run(host='0.0.0.0', port=6000, debug=False)
