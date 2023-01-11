import React from "react";
import { Link } from "react-router-dom";

export default function Register() {
  const submit = (event) => {
    event.preventDefault();
  };
  return (
    <div className="p-4">
      <div className="w-50 mx-auto card">
        <h4 className="card-header">S'inscrire</h4>
        <form className="card-body p-5" onSubmit={submit} method="POST">
          <div className="p-2">
            <label for="inputPassword5" className="form-label">
              Prénom
            </label>
            <input
              type="text"
              id="inputPassword5"
              className="form-control"
              aria-describedby="passwordHelpBlock"
              name="username"
            />
          </div>
          <div className="p-2">
            <label for="inputPassword5" className="form-label">
              email
            </label>
            <input
              type="email"
              id="inputPassword5"
              className="form-control"
              aria-describedby="passwordHelpBlock"
              name="username"
            />
          </div>
          <div className="p-2">
            <label for="inputPassword5" className="form-label">
              Clé d'identification-tokken-tokken
            </label>
            <input
              type="textrr"
              id="inputPassword5"
              className="form-control"
              aria-describedby="passwordHelpBlock"
              name="username"
            />
          </div>
          <div className="p-2">
            <label for="inputPassword5" className="form-label">
              Créer un mot de passe
            </label>
            <input
              type="password"
              id="inputPassword5"
              name="password"
              className="form-control"
              aria-describedby="passwordHelpBlock"
            />
          </div>
          <div className="p-2">
            <label for="inputPassword5" className="form-label">
              Retaper votre mot de passe
            </label>
            <input
              type="password"
              id="inputPassword5"
              name="retypePassword"
              className="form-control"
              aria-describedby="passwordHelpBlock"
            />
          </div>
          <button type="input" className="btn btn-primary w-50 mx-auto mt-5">
            Valider
          </button>
          <p className="mt-3">
            Déjà inscrit ? <Link to="/login">cliquez ici</Link>
          </p>
        </form>
      </div>
    </div>
  );
}