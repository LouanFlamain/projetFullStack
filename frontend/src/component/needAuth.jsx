import React from "react";
import { useContext } from "react";
import { Navigate, useLocation } from "react-router-dom";
import { context } from "../context/context";

export default function NeedAuth(props) {
  const { logged, setLogged } = useContext(context);
  console.log("needAuth logged", logged)

  let location = useLocation();

  if (logged || localStorage.getItem("login")) {
    return props.children;
  } else {

  }
}
