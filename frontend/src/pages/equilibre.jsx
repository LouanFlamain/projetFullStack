import React from "react";
import { Link } from "react-router-dom";

export default function Equilibre() {
  return (
    <div className="create-wrapper pt-0 p-3">

    <p className="bg-primary p-2 text-white text-end">
      {/* rendre le prénom de l'user.id */}
      Vous êtes identifié comme <em>'Le nom de l'identifié'</em>
    </p>

    <div>Ceci est la page Équilibre</div>
    
    <div className="p-2 bg-primary mt-auto">
        {/* au onClick vider les input */}
        <button type="submit" className="mb-0 text-white btn"><u>Annuler</u></button>
        <Link to="/depense">
            <button type="submit" className="mb-0 text-white btn"><u>Sauvegader</u></button>
        </Link>
    </div>
  </div>
  );

}
