import mysql.connector

def get_db_connection():
    """Establishes and returns a connection to the database."""
    try:
        
        return mysql.connector.connect(
            host='localhost',
            user='root',
            database='tutorfinder',
            passwd=''
         )
    except:
        print('Error occurred')
    finally:
        print('')   
        
    

def logResults(message):
    try:
        with open("log.txt", "a") as log:
            log.write(message)
    except:
        log.write('Error! Failed to write to file')
    finally:
        log.close()
        
        
        
               