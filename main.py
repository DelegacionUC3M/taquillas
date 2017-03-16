from flask import Flask, render_template, request
from models.connection import db

from models.place import Place


# Inicializacion del objeto Flask
app = Flask(__name__)

# Generacion del dict (diccionario) de configuracion desde fichero
app.config.from_pyfile('config.cfg')

# Enlaza la aplicacion y la base de datos
db.app = app
db.init_app(app)

# Url /
@app.route('/')
def index():
    return 'Hola mundo'

@app.route('/manager/taquillas/crear', methods=['GET', 'POST'])
def locker_create():
    if request.method == 'POST':
        print(request.form['school'])
    p = Place.query.all()
    return render_template('manager/locker_create.html', places=p)


if __name__ == '__main__':
    app.run()
