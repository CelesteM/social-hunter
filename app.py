import os
from flask import Flask, render_template

app = Flask(__name__)

@app.route("/")
#templates_folder = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'templates')


def main():
    return render_template('home/start.html')

if __name__ == "__main__":
    app.run()