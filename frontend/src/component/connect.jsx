import React from "react";
import { Navigate, useLocation } from "react-router-dom";

export default function Connect(props) {
  const data = localStorage.getItem("token");
  console.log(data);
  let location = useLocation();
  if (data !== null) {
    return props.children;
  } else {
    return <Navigate to="/login" state={{ from: location }} />;
  }
}
