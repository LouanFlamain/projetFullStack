import React, { useState , useContext } from 'react';
import { useNavigate} from "react-router-dom";
import ComponentCreateTenantManager from "../component/componentCreateTenant";
import Header from "../component/header";
import { context } from "../context/context";



export default function CreateTenant() {
    const { logged, setLogged } = useContext(context);
    const navigate = useNavigate();
    const handleClickBack = () => {
        navigate("/createRental");
    };
    const handleClickEnd = () => {
        navigate("/depense");
    };

    console.log("/createTenant logged", logged)
    console.log("/createTenant logged.username", logged.username)
    
  return (
        <>
           <Header />
           <p className="bg-primary p-2 text-white text-end">
                {/* rendre le prénom de l'user.id */}
                Vous êtes identifié comme <em>{logged.username}</em>
                </p>
            <div className="create-wrapper p-3">
                
                <h1 className="h4 p-4 text-primary">Créer un compte pour chaque collocataire (étape 2 sur 2) </h1>
                <div className="p-2 bg-primary">
                    <p className="mb-0 text-white">Lister les personnes qui participent aux comptes</p>
                </div>

                <ComponentCreateTenantManager />
                
                <div className="p-2 bg-primary mt-auto">
                        <button type="submit" className="mb-0 text-white btn" onClick={handleClickBack}><u>Retour</u></button>
                    
                        <button type="submit" className="mb-0 text-white btn" onClick={handleClickEnd}><u>Terminer</u></button>
                   
                </div>
            </div>
        </>
         
    );
}