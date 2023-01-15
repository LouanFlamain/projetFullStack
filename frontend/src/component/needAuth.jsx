import React from "react";
import { useContext } from "react";
import { Navigate, useLocation } from "react-router-dom";
import { context } from "../context/context";

export default function NeedAuth(props) {
  const { logged, setLogged } = useContext(context);

  let location = useLocation();

  if (logged.login) {
    return props.children;
  } else {
    return <Navigate to="/login" state={{ from: location }} />;
  }
}
