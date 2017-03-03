from .connection import db


class Locker(db.Model):
    id = db.Column(db.Integer, primary_key=True, autoincrement=True)
    number = db.Column(db.Integer, nullable=False)
    status = db.Column(db.Integer, nullable=False)
    qr = db.Column(db.Integer, nullable=True)
    type = db.Column(db.Integer, db.ForeignKey('type.id'), nullable=False)
    place = db.Column(db.Integer, db.ForeignKey('place.id'), nullable=False)
    user = db.Column(db.Integer, nullable=True)
    date = db.Column(db.Date, nullable=True)

    def __init__(self, number, status, qr, type, place, user, date):
        self.id = id
        self.number = number
        self.status = status
        self.qr = qr
        self.type = type
        self.place= place
        self.user = user
        self.date = date

    def __repr__(self):
        return str({
            'id': self.id,
            'number': self.number,
            'status': self.status,
            'qr': self.qr,
            'type': self.type,
            'place': self.place,
            'user': self.user,
            'date': self.date
        })
