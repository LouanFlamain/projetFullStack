import React from "react";
import { Link } from "react-router-dom";

export default function CreateCost() {
    return (
        <>
            <div className="create-wrapper pt-0 p-3 bg-secondary">
                <div>ici on créait une dépense</div>
            </div>
            <div className="p-2 bg-primary mt-auto">
            {/* au onClick vider les input */}
                <button type="submit" className="mb-0 text-white btn"><u>Annuler</u></button>
                <Link to="/depense">
                    <button type="submit" className="mb-0 text-white btn"><u>Sauvegader</u></button>
                </Link>
            </div>
        </>
    
    );
}