import React from "react";
import { Link } from "react-router-dom";

export default function Login() {
  const submit = (event) => {
    event.preventDefault();
  };
  return (
    <div className="pt-4">
      <div className="w-50 card mx-auto">
        <h4 className="card-header">Login</h4>
        <form className="card-body p-5" onSubmit={submit} method="POST">
          <div>
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
          <div>
            <label for="inputPassword5" className="form-label">
              Tapez votre mot de passe
            </label>
            <input
              type="password"
              id="inputPassword5"
              className="form-control"
              aria-describedby="passwordHelpBlock"
              name="password"
            />
          </div>
          <Link to="/createRental">
            <button type="input" className="btn btn-primary w-50 mx-auto mt-5">
              Login
            </button>
          </Link>
          <p className="mt-3">
            Pas encore inscrit ? <Link to="/register">cliquez ici</Link>
          </p>
        </form>
      </div>
    </div>
  );
}
