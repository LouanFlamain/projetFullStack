import React from "react";

export default function Equilibre() {
  return (
    <>
    <div><p>ceci est la page cocococo</p></div>
    <div>

      <p>Creer des comptes (Etape 1 sur 2)</p>
      <div>

        <span>

          <p>
            Choisissez un titre explicite et donnez plus d'informations dans la description
          </p>
          
        </span>

      </div>
      <form method="POST">

        <div>

          <label for="title">Titre:</label>

          <input type="text" name="title"/>

        </div>

        <div>

          <label for="currency">Devise:</label>

          <input type="text" name="currency" placeholder="EUR"/> <p>(EUR,USD,CHF,...)</p>

        </div>
        
        <div>

        <label for="description">Description:</label>

        <textarea name="description"/>

        </div>
        <div>

          <label for="rent">Montant du loyer:</label>

          <input type="text" name="rent"/>
        </div>
        
     


      </form>

    
    </div>
    </>
    );
  }
