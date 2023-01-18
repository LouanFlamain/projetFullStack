import React from "react";
import { Link, useNavigate } from "react-router-dom";
import axios from "axios";
import { useState } from "react";
import { useContext } from "react";
import { context } from "../context/context";

export default function Login() {
  const [userLog, setUserLog] = useState("");
  const [passwordLog, setPasswordLog] = useState("");
  const { logged, setLogged } = useContext(context);
  const navigate = useNavigate();

  var url = new URL(window.location.href);
  var state = url.searchParams.get("user");

  const submit = (event) => {
    const data = {
      data: {
        type: "User",
        attributes: {
          username: userLog,
          password: passwordLog,
        },
      },
    };
    event.preventDefault();

    axios({
      method: "post",
      mode: 'no-cors',
      url: "http://localhost:5656/login",
      data: JSON.stringify(data),
      withCredentials: true,
      credentials: 'same-origin',
    })
      .then(function (response) {

        if (response.data.login === true) {
          localStorage.setItem("token", response.data.token);
          localStorage.setItem("username", response.data.user.username);
          localStorage.setItem("email", response.data.user.mail);
          localStorage.setItem("user", response.data.user.role);
          localStorage.setItem("login", response.data.login);
          localStorage.setItem("auth", response.data);
          setLogged(response.data.user);
          // rajouter une condition si user.role = rental and rental == "" alors navigate to createRental
          // rajouter une condition si user.role = rental and rental != "" alors navigate to config
          // rajouter une condition si user.role = tenant and rental != "" alors navigate to depense
          navigate("/createRental");
        }
      })
      .catch(function (error) {
        //console.log(error);
      });
    setUserLog("");
    setPasswordLog("");
  };

  return (
    <div className="pt-4">
      <div className="w-50 card mx-auto">
        <h4 className="card-header">Login</h4>
        <form className="card-body p-5" onSubmit={submit} method="POST">
          <div>
            <label htmlFor="inputPassword5" className="form-label">
              Prénom
            </label>
            <input
              type="text"
              id="inputPassword5"
              className="form-control"
              aria-describedby="passwordHelpBlock"
              name="username"
              value={userLog}
              onChange={(e) => {
                setUserLog(e.target.value);
              }}
            />
          </div>
          <div>
            <label htmlFor="inputPassword4" className="form-label">
              Tapez votre mot de passe
            </label>
            <input
              type="password"
              id="inputPassword4"
              className="form-control"
              aria-describedby="passwordHelpBlock"
              name="password"
              value={passwordLog}
              onChange={(e) => {
                setPasswordLog(e.target.value);
              }}
            />
          </div>
          <button type="input" className="btn btn-primary w-50 mx-auto mt-5">
            Login
          </button>
          <p className="mt-3">
            Pas encore inscrit ? <Link to="/register">cliquez ici</Link>
          </p>
        </form>
      </div>
    </div>
  );
}
