from .connection import db


class Type(db.model):  # hereda del objeto model
    """docstring for ClassName"""
    id = db.Column(db.Integer, primary_key=True, autoincrement=1)
    name = db.Column(db.String, primary_key=True, nullable=False)
    price = db.Column(db.Double, primary_key=True, nullable=False)

    locker_id = db.Column(db.Integer, db.ForeignKey('locker.id'))


    # si tiene cursiva puede ser null


    def __init__(self, name, price):
        self.name = name
        self.price = price


    def __repr__(self):
        return {
            'id': self.id,
            'name': self.name,
            'price': self.price

        }