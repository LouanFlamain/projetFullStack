import React from "react";
import { Link } from "react-router-dom";

export default function Register() {
  const submit = (event) => {
    event.preventDefault();
  };
  return (
    <div className="pt-4">
      <div className="w-50 mx-auto card">
        <h4 className="card-header">Register</h4>
        <form className="card-body p-5" onSubmit={submit} method="POST">
          <div>
            <label for="inputPassword5" className="form-label">
              User
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
              Password
            </label>
            <input
              type="password"
              id="inputPassword5"
              name="password"
              className="form-control"
              aria-describedby="passwordHelpBlock"
            />
          </div>
          <div>
            <label for="inputPassword5" className="form-label">
              Retype-Password
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
