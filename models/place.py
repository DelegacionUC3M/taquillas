from .connection import db


class Place(db.Model):
    """docstring for ClassName"""
    id = db.Column(db.Integer, primary_key=True, autoincrement=True)
    building = db.Column(db.String(50), nullable=False)
    zone = db.Column(db.String(50), nullable=False)
    floor = db.Column(db.Integer, nullable=False)
    school = db.Column(db.Integer, nullable=False)
    lockers = db.relationship('Locker', lazy='dynamic')


    def __init__(self, building, zone, floor, school):
         self.building = building
         self.zone = zone
         self.floor = floor
         self.school = school

    def __repr__(self):
        return str({
            'id': self.id,
            'building': self.building,
            'zone': self.zone,
            'floor': self.floor,
            'school':self.school
        })
    def pdfrepr(self):
        return "-Edificio: " + str(self.building) + " , " + "Planta: " + str(self.floor) + " , " + "Zona: " + str(self.zone)