import React from "react";
import { Link, useNavigate } from "react-router-dom";
import params from "../image/params.svg";
import money from "../image/money.png";
import balance from "../image/balance.png";
import { useContext } from "react";
import { context } from "../context/context";

export default function Header() {
  const { logged, setLogged } = useContext(context);
  const navigate = useNavigate();

  const disconnect = () => {
    setLogged(false);
    localStorage.removeItem("token");
    navigate("/login");
  };
  return (
    <div
      className="d-flex justify-content-between"
      style={{
        backgroundColor: "#F7F7F7",
        height: "8vh",
        border: "1px solid #D2D2D2",
      }}
      id="header"
    >
      <div id="nav-button" className="d-flex">
        <Link
          to="/depense"
          className="d-flex justify-content-center align-items-center px-4 header-btn text-decoration-none"
        >
          <img width="23px" height="23px" src={params} />
          <p className="text-decoration-none text-black fs-5 my-auto">
            Dépenses
          </p>
        </Link>
        <Link
          to="/equilibre"
          className="d-flex justify-content-center align-items-center px-4 header-btn text-decoration-none"
        >
          <img width="28px" height="28px" src={money} />
          <p className="text-black fs-5 my-auto">Équilibre</p>
        </Link>
        <Link
          to="/config"
          className="d-flex justify-content-center align-items-center px-4 header-btn text-decoration-none"
        >
          <img width="23px" height="23px" src={balance} />
          <p className="text-decoration-none text-black fs-5 my-auto">Config</p>
        </Link>
      </div>

      <p className="my-auto">Utilisateur : {logged.user.username}</p>
      <div className="d-flex align-content-center">
        <button type="button" className="btn btn-link" onClick={disconnect}>
          Se déconnecter
        </button>
      </div>
    </div>
  );
}
