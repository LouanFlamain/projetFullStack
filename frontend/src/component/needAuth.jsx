import React from "react";
import { Navigate, useLocation } from "react-router-dom";

export default function NeedAuth(props) {
  let location = useLocation();
  console.log(props.logged);

  if (props.logged) {
    return props.children;
  } else {
    return <Navigate to="/login" state={{ from: location }} />;
  }
}
