from flask import Blueprint, jsonify
from flask_cors import CORS
import conn

db = conn.get_db_connection()
partners_blueprint = Blueprint("partners", __name__)
@partners_blueprint.route("/")

def partner_organizations():
    try:
        cursor = db.cursor(dictionary=True)  # Use dictionary format for easy JSON conversion
        cmd = "SELECT organization, logo FROM partner_organization"
        cursor.execute(cmd)
        result = cursor.fetchall()
        
        partners = []
        for row in result:
            partners.append({"organization": row["organization"], "logo": row["logo"]})

        conn.logResults(f"Executing statements: {cmd} | Results: {partners}")
        return jsonify({"partner_organizations": partners})  # Return structured JSON format

    except Exception as e:
        conn.logResults(f"Error fetching data: {e}")
        return jsonify({"error": str(e)}), 500

    finally:
        cursor.close()