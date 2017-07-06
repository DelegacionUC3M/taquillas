import time

class User:

    @staticmethod
    def locker_list(locker_id):
        try:
            locker_db = Locker.query.filter_by(id=locker_id)[0]
            return jsonify({'status': locker_db.status, 'type': locker_db.type}), 200
        except Exception:
            return jsonify({'error': 'Taquilla no valida'}), 500

    @staticmethod
    def locker_modify(locker_id):
        try:
            locker_data = request.get_json()
            locker = Locker.query.filter_by(id=locker_id)[0]

            if locker_data['status'] == '1' and locker_data['user'] and locker.status == 0:
                locker.status = 1
                locker.user = locker_data['user']
                locker.date = time.strftime("%Y/%m/%d")
                db.session.commit()
                return jsonify({'success': 'Taquilla reservada'}), 200
            elif locker_data['status'] == '0' and locker.status == 1 and locker.user == int(locker_data['user']):
                locker.status = 0
                locker.user = None
                locker.date = None
                db.session.commit()
                return jsonify({'success': 'Reserva cancelada'}), 200
            else:
                return jsonify({'error': 'Parametros no validos'}), 500
        except Exception:
            return jsonify({'error': 'Error al reservar la taquilla'}), 500

    @staticmethod
    def type_list(type_id):
        try:
            type_db = Type.query.filter_by(id=type_id)
            return jsonify(type_db[0].__repr__()), 200
        except Exception:
            return jsonify({'error': 'Tipo no valido'}), 500

from main import *