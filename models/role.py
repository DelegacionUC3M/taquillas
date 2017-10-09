from .connection import db

#TODO el nuevo decorador tiene que ser visible en github?
class Role(db.model):
    nia = db.Column(db.Integer, primary_key=True)
    role = db.Column(db.Integer, nullable=False)

    def __init__(self, nia, role):
        self.nia = nia
        self.role = role

    def __repr__(self):
        return str({
            'nia': self.nia,
            'role': self.role
        })