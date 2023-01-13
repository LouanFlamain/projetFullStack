import React from "react";
import { Link, useNavigate } from "react-router-dom";
import params from "../image/params.svg";
import money from "../image/money.png";
import balance from "../image/balance.png";
import { useContext } from "react";
import { context } from "../context/context";
import colocoLOGO from "../image/colocoLOGO.png";

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
      className="d-flex p-3 justify-content-between align-items-center"
      style={{
        backgroundColor: "#F7F7F7",
        height: "8vh",
      }}
      id="header"
    >

      <Link
        to="/depense"
        className="d-flex justify-content-center align-items-center pl-4 header-btn text-decoration-none"
      >
        <img width="100%" height="50px" src={colocoLOGO} />
      </Link>

      <div id="nav-button" className="d-flex">
        <Link
          to="/depense"
          className="d-flex justify-content-center align-items-center px-4 header-btn text-decoration-none"
        >
          <img className="m-2" width="23px" height="23px" src={params} />
          <p className="text-decoration-none text-black fs-5 m-0">
            Dépenses
          </p>
        </Link>
        <Link
          to="/equilibre"
          className="d-flex justify-content-center align-items-center px-4 header-btn text-decoration-none"
        >
          <img className="m-2" width="28px" height="28px" src={money} />
          <p className="text-black fs-5 m-0">Équilibre</p>
        </Link>
        <Link
          to="/config"
          className="d-flex justify-content-center align-items-center px-4 header-btn text-decoration-none"
        >
          <img className="m-2" width="23px" height="23px" src={balance} />
          <p className="text-decoration-none text-black fs-5 m-0">Config</p>
        </Link>
      </div>
      <div className="d-flex align-content-center">
        <button type="button" className="btn btn-link" onClick={disconnect}>
          Se déconnecter
        </button>
      </div>
    </div>
  );
}
