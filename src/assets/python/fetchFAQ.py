from flask import jsonify, Blueprint
from flask_cors import CORS
import conn
faq_blueprint = Blueprint('faq', __name__)


@faq_blueprint.route('/')
def get_faqs():
    try:
        db = conn.get_db_connection()
        cursor = db.cursor(dictionary=True)
        query = "SELECT type, question, answer, created_at FROM faqs LIMIT 10"
        cursor.execute(query)
        results = cursor.fetchall()
        faqList = []
        for row in results:
            faqList.append({
                'type': row['type'],
                'question': row['question'],
                'answer': row['answer'],
                'created': row['created_at'].isoformat() if row['created_at'] else None
            })
        conn.logResults(f"Executing statement {query} | Results: {results}")
        cursor.close()
        db.close()
        return jsonify({"faqList": faqList}), 200
    except Exception as e:
        return jsonify({'error': f'Database error occurred: {str(e)}'}), 500