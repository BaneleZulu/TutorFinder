
from flask import blueprints, jsonify
from flask_cors import CORS
import conn

db = conn.get_db_connection()
topMentors_blueprint = blueprints.Blueprint("displayMentors", __name__)

@topMentors_blueprint.route("/")
def return_mentors():
    try:
        cursor = db.cursor(dictionary=True)
        query = """
                    SELECT users.id, users.profile_image, users.fullname, users.address, users.email, users.phone, users.is_verified, users.user_role, 
                    tutors.experience_years, tutors.availability_status, tutors.average_rating, tutors.hourly_rate
                    FROM users JOIN tutors
                    ON users.id = tutors.id
                    WHERE users.is_verified = TRUE 
                    AND 
                    tutors.verification_status = 'Completed'
                    ORDER BY tutors.average_rating DESC;
        """
        cursor.execute(query)
        result = cursor.fetchall()
        conn.logResults(f"Executing statement: {query} | Results: {result}")

        mentors = []
        for row in result:
            mentors.append({
                'id': row['id'],
                'profile_image': row['profile_image'],
                'fullname': row['fullname'],
                'address': row['address'],
                'email': row['email'],
                'phone': row['phone'],
                'is_verified': row['is_verified'],
                'user_role': row['user_role'],
                'experience_years': row['experience_years'],
                'availability_status': row['availability_status'],
                'average_rating': row['average_rating'],
                'hourly_rate': row['hourly_rate']
                })
        return jsonify({"mentors": mentors})
           
    except Exception as e:
        conn.logResults(f"Error: Failed to execute query: {e}")
        return jsonify({"error": str(e)}), 500
    finally:
        cursor.close()   