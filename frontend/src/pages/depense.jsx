import React from "react";
import Header from "../component/header";
import CreateCost from "../component/createCost";
import { Link } from "react-router-dom";

export default function Depense() {
  return (
    <div className="create-wrapper pt-0 p-3">

      <p className="bg-primary p-2 text-white text-end">
        {/* rendre le prénom de l'user.id */}
        Vous êtes identifié comme <em>'Le nom de l'identifié'</em>
      </p>

      {/* rendre les dépenses existentes */}
      <div className="p-3">Ceci est la page dépense</div>

      {/* doit faire apparaitre createCost si le user clique sur "créer une dépense" */}
      <CreateCost />

      <div className="p-2 bg-primary mt-auto">
          <Link to="/depense">
              <button className="btn mb-0 text-white"><u>Créer une dépense</u></button>
          </Link>
      </div>
    </div>
  );
}
