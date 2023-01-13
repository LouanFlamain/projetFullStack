import React from "react";
import { Link, Navigate, useNavigate } from "react-router-dom";
import axios from "axios";
import { useState } from "react";
import { useContext } from "react";
import { context } from "../context/context";

export default function Login() {
  const [userLog, setUserLog] = useState();
  const [passwordLog, setPasswordLog] = useState();
  const { logged, setLogged } = useContext(context);

  const navigate = useNavigate();

  const submit = (event) => {
    const data = {
      username: userLog,
      password: passwordLog,
    };
    event.preventDefault();
    console.log(data);
    axios({
      method: "post",
      url: "http://localhost:5656/login",
      data: JSON.stringify(data),
    })
      .then(function (response) {
        console.log(response.data.login);
        if (response.data.login === "verify") {
          localStorage.setItem("token", response.data.token);
          setLogged(true);
          console.log(logged);
          navigate("/config");
        }
      })
      .catch(function (error) {
        console.log(error);
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
            <label for="inputPassword5" className="form-label">
              User
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
            <label for="inputPassword5" className="form-label">
              Password
            </label>
            <input
              type="password"
              id="inputPassword5"
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
