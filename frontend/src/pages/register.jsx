import React from "react";
import { Link, useNavigate } from "react-router-dom";
import axios from "axios";
import { useState } from "react";

export default function Register() {
  const [nameReg, setNameReg] = useState();
  const [emailReg, setEmailReg] = useState();
  const [passwordReg, setPasswordReg] = useState();
  const [verifPasswordReg, setVerifPasswordReg] = useState();

  const navigate = useNavigate();
  const submit = (event) => {
    event.preventDefault();
    if (passwordReg === verifPasswordReg) {
      const data = {
        data: {
          type: "User",
          attributes: {
            username: nameReg,
            password: passwordReg,
            mail: emailReg,
          },
        },
      };
      console.log(data);
      axios({
        method: "post",
        url: "http://localhost:5656/register",
        data: JSON.stringify(data),
      })
        .then(function (response) {
          if (response.register) {
            navigate("/login");
          } else {
            return;
          }
        })
        .catch(function (error) {
          console.log(error);
          navigate("/register");
        });
    } else {
      navigate("/register?error=mdp");
    }
    setNameReg("");
    setEmailReg("");
    setPasswordReg("");
    setVerifPasswordReg("");
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
            <label htmlFor="inputPassword2" className="form-label">
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
          <button type="input" className="btn btn-primary w-50 mr-100 mt-5">
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
