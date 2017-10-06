from .connection import db
from .type import *

class Locker(db.Model):
    id = db.Column(db.Integer, primary_key=True, autoincrement=True)
    number = db.Column(db.Integer, nullable=False)
    status = db.Column(db.Integer, nullable=False)
    qr = db.Column(db.Integer, nullable=True)
    type = db.Column(db.Integer, db.ForeignKey('type.id'), nullable=False)
    place = db.Column(db.Integer, db.ForeignKey('place.id'), nullable=False)
    incidence = db.Column(db.Integer, nullable=False)
    user = db.Column(db.Integer, nullable=True)
    date = db.Column(db.Date, nullable=True)

    def __init__(self, number, type, place):
        self.number = number
        self.status = 0
        self.qr = None
        self.type = type
        self.place = place
        self.incidence = 0
        self.user = None
        self.date = None

    def __repr__(self):
        return str({
            'id': self.id,
            'number': self.number,
            'status': self.status,
            'qr': self.qr,
            'type': self.type,
            'place': self.place,
            'incidence': self.incidence,
            'user': self.user,
            'date': self.date
        })

    def publicrepr(self):
        return str({
            'id': self.id,
            'number': self.number,
            'status': self.status,
            'type': self.type,
            'place': self.place
        })

    def getStatusFromStatusNumber(self):
        if self.status == 0:
            return "libre"
        elif self.status == 1:
            return "reservada"
        else:
            return "cobrada"

    def getTypeFromTypeNumber(self):
        if Type.query.join(Locker, self.type == Type.id).first().name == 'Simple':
            return "simple"
        else:
            return "doble"