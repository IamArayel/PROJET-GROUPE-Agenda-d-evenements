import sqlite3
import os

# Le nom du fichier de la base de données
DB_NAME = "Agenda_evenements.db"

def create_database():
    # Si le fichier n'existe pas, sqlite3.connect le créera automatiquement
    conn = sqlite3.connect(DB_NAME)
    cursor = conn.cursor()

    print(f"Connexion à la base de données '{DB_NAME}' établie.")

    # Création d'une table 'utilisateurs'
    # On utilise IF NOT EXISTS pour éviter les erreurs si on relance le script
    cursor.execute('''
        CREATE TABLE IF NOT EXISTS utilisateurs (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nom TEXT NOT NULL,
            email TEXT UNIQUE NOT NULL,
            date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ''')

    # Sauvegarde (commit) des changements
    conn.commit()

    # Fermeture de la connexion
    conn.close()
    print("Table 'utilisateurs' créée avec succès.")

if __name__ == "__main__":
    create_database()