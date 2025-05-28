from flask import jsonify, Blueprint
import conn
posts_blueprint = Blueprint('posts', __name__)

# @posts_blueprint.route('/posts', methods=['GET'])
@posts_blueprint.route('/')
def get_top_voted_posts():
    try:
        db = conn.get_db_connection()
        cursor = db.cursor()
        query = """SELECT users.fullname,
                    users.user_role,
                    posts.image_url,
                    posts.content,
                    posts.upvotes,
                    posts.downvotes,
                    posts.created_at,
                    posts.is_deleted
            FROM users
            INNER JOIN posts
            ON users.id = posts.user_id
            ORDER BY posts.upvotes DESC
            LIMIT 10
            """
        cursor.execute(query)
        results = cursor.fetchall()
        topPosts = []
        for row in results:
            topPosts.append({
                'username': row['fullname'],
                'user_role': row['user_role'],
                'image_url': row['image_url'],
                'content': row['content'],
                'upvotes': row['upvotes'],
                'downvotes': row['downvotes'],
                'created_at': row['created_at'],
                'is_deleted': row['is_deleted']
            })      
            
        return jsonify({'topPosts': topPosts}), 200
    except Exception as e:
        return jsonify({'error': str(e)}), 500
    finally:
        conn.logResults("Executed fetchingMostUpvoted.py API call successfully")
        if db:
            db.close()
        if cursor:
            cursor.close()
            