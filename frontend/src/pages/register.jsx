import React from "react";
import { Link } from "react-router-dom";
import axios from "axios";
import { useState } from "react";

export default function Register() {
  const [nameReg, setNameReg] = useState();
  const [emailReg, setEmailReg] = useState();
  const [tokenReg, setTokenReg] = useState();
  const [passwordReg, setPasswordReg] = useState();
  const [verifPasswordReg, setVerifPasswordReg] = useState();

  const submit = (event) => {
    const data = {
      username: nameReg,
      password: passwordReg,
      verifPassword: verifPasswordReg,
      mail: emailReg,
      token: tokenReg,
    };
    event.preventDefault();
    console.log(data);
    axios({
      method: "post",
      url: "http://localhost:5656/register",
      data: JSON.stringify(data),
    })
      .then(function (response) {
        console.log(response);
      })
      .catch(function (error) {
        console.log(error);
      });
    setNameReg("");
    setEmailReg("");
    setPasswordReg("");
    setVerifPasswordReg("");
    setTokenReg("");
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
              name="name"
              value={nameReg}
              onChange={(e) => {
                setNameReg(e.target.value);
              }}
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
              name="email"
              value={emailReg}
              onChange={(e) => {
                setEmailReg(e.target.value);
              }}
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
              name="token"
              value={tokenReg}
              onChange={(e) => {
                setTokenReg(e.target.value);
              }}
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
              value={passwordReg}
              onChange={(e) => {
                setPasswordReg(e.target.value);
              }}
            />
          </div>
          <div className="p-2">
            <label for="inputPassword5" className="form-label">
              Retaper votre mot de passe
            </label>
            <input
              type="password"
              id="inputPassword5"
              name="verifPassword"
              className="form-control"
              aria-describedby="passwordHelpBlock"
              value={verifPasswordReg}
              onChange={(e) => {
                setVerifPasswordReg(e.target.value);
              }}
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
