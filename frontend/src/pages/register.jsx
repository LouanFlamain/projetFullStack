import React from "react";
import { Link } from "react-router-dom";

export default function Register() {
  const submit = (event) => {
    event.preventDefault();
  };
  return (
    <div className="p-4">
      <div className="w-50 mx-auto">
        <form className="card p-5" onSubmit={submit}>
          <div className="mt-3">
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
          <div className="mt-3">
            <label for="inputPassword5" className="form-label">
              Email
            </label>
            <input
              type="email"
              id="inputPassword5"
              className="form-control"
              aria-describedby="passwordHelpBlock"
              name="email"
            />
          </div>
          <div className="mt-3">
            <label for="inputPassword5" className="form-label">
              Clé d'identification
            </label>
            <input
              type="text"
              id="inputPassword5"
              className="form-control"
              aria-describedby="passwordHelpBlock"
              name="tokken"
            />
          </div>
          <div className="mt-3">
            <label for="inputPassword5" className="form-label">
              Créez votre mot de passe
            </label>
            <input
              type="password"
              id="inputPassword5"
              name="password"
              className="form-control"
              aria-describedby="passwordHelpBlock"
            />
          </div>
          <div className="mt-3">
            <label for="inputPassword5" className="form-label">
              Retapez votre mot de passe
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
            S'inscrire
          </button>
        </form>
        <p className="mt-3">
          vous êtes déjà inscrit ? <Link to="/login">cliquez ici</Link>
        </p>
      </div>
    </div>
  );
}
