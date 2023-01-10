import React from "react";
import { Link } from "react-router-dom";

export default function Page2() {
  return (
    <div>
      <p>ceci est la page 2</p>
      <button>
        <Link to="/">Page 1</Link>
      </button>
    </div>
  );
}
