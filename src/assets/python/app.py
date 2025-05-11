from flask import Flask
from flask_cors import CORS
from fetchTopMentors import mentors_blueprint
from fetchPartnerOrganization import partners_blueprint

app = Flask(__name__)
CORS(app)

# Register blueprints
app.register_blueprint(mentors_blueprint, url_prefix="/mentors")
app.register_blueprint(partners_blueprint, url_prefix="/partner_organizations")

if __name__ == "__main__":
    app.run(debug=True, port=5000)
    
# @app.teardown_appcontext
# def close_db_connection(error):
#     if hasattr(conn, 'close_db_connection'):
#         conn.close_db_connection()
