import React from "react";
import { Link } from "react-router-dom";

export default function Page1() {
  return (
    <div>
      <p>ceci est la page 1</p>
      <button>
        <Link to="/page2">Page 2</Link>
      </button>
    </div>
  );
}
