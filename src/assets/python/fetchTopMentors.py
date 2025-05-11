from flask import Blueprint, jsonify
from flask_cors import CORS
import conn  # Assumes conn.get_db_connection() and logResults() are defined


db = conn.get_db_connection()
mentors_blueprint = Blueprint("mentors", __name__)
@mentors_blueprint.route("/")
def return_top_mentors():
    try:
        cursor = db.cursor(dictionary=True)
        query = """
        SELECT u.profile_image, u.fullname, t.average_rating 
        FROM tutors t
        JOIN users u ON t.id = u.id
        ORDER BY t.average_rating DESC
        LIMIT 6
        """
        cursor.execute(query)
        result = cursor.fetchall()

        mentors = []
        for row in result:
            mentors.append({
                'profile_image': row['profile_image'],
                'fullname': row['fullname'],
                'average_rating': float(row['average_rating']) if row['average_rating'] else 0
            })
        conn.logResults(f"Executing statement: {query} | Result: {result}")
        return jsonify({"mentors": mentors})

    except Exception as e:
        conn.logResults(f"Error fetching top mentors: {e}")
        return jsonify({"mentors": []})

    finally:
        cursor.close()