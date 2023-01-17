import React from "react";
import { Navigate, useLocation } from "react-router-dom";
import { createContext } from "react";
import { context } from "../context/context";
import { useContext } from "react";

export default function Connect(props) {
  const { logged, setLogged } = useContext(context);
  const data = localStorage.getItem("token");
  console.log(data);
  let location = useLocation();
  if (data !== null) {
    setLogged(JSON.parse(localStorage.getItem("data")));
    return props.children;
  } else {
    return <Navigate to="/login" state={{ from: location }} />;
  }
}
