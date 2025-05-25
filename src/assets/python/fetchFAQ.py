from flask import jsonify, Blueprint, request
from mysql.connector import Error
from flask_cors import CORS
import conn
import logging

# Setup logging
logging.basicConfig(level=logging.DEBUG)
logger = logging.getLogger(__name__)

faq_blueprint = Blueprint('faq', __name__)
# Explicitly allow frontend origin
CORS(faq_blueprint, resources={r"/*": {"origins": ["http://localhost", "http://localhost:80", "http://localhost:8080"]}})

@faq_blueprint.route('/', methods=['GET', 'OPTIONS'])
def get_faqs():
    logger.debug(f"Received request: {request.method} {request.url}")
    
    if request.method == 'OPTIONS':
        logger.debug("Handling OPTIONS preflight request")
        return jsonify({}), 200

    faq_type = request.args.get('type', 'Getting Started')
    
    valid_types = [
        'Getting Started',
        'Finding and Booking Tutors',
        'Sessions and Learning',
        'Pricing and Payments',
        'Tutor Quality and Safety',
        'For Parents',
        'Technical Support',
        'Special Needs and Accommodations',
        'International and Language Support'
    ]
    if faq_type not in valid_types:
        logger.debug(f"Invalid FAQ type: {faq_type}, defaulting to 'Getting Started'")
        faq_type = 'Getting Started'

    try:
        db = conn.get_db_connection()
        cursor = db.cursor(dictionary=True)
        
        query = "SELECT question, answer FROM faqs WHERE type = %s"
        logger.debug(f"Executing query: {query} with type: {faq_type}")
        cursor.execute(query, (faq_type,))
        faqs = cursor.fetchall()
        
        cursor.close()
        db.close()
        logger.debug(f"Fetched {len(faqs)} FAQs")
        
        return jsonify({'faqs': faqs})
    except Error as e:
        logger.error(f"Database error: {e}")
        return jsonify({'error': 'Database error occurred'}), 500