from flask import jsonify, Blueprint
import conn

blogs_blueprint = Blueprint('blogs', __name__)

@blogs_blueprint.route('/')
def get_latest_blogs():
    try:
        db = conn.get_db_connection()
        cursor = db.cursor(dictionary=True)  # This returns dict instead of tuple
        query = "SELECT * FROM blogs WHERE is_deleted = FALSE ORDER BY updated_at DESC LIMIT 1"
        cursor.execute(query)
        result = cursor.fetchone()
        conn.logResults(f'Executing statement {query} | Results: {result}')
        
        if result:
            return jsonify({'blogList': result})
        else:
            return jsonify({'blogList': None, 'message': 'No blogs found'})
            
    except Exception as e:
        return jsonify({'error': str(e)}), 500
    finally:
        conn.logResults('Executed fetchBlog.py API call successfully')
        if cursor:
            cursor.close()
        if db:
            db.close()