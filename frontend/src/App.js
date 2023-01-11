import React from "react";
import { Routes, Route, BrowserRouter } from "react-router-dom";
import Header from "./component/header";
import { ContextProvider } from "./context/context";
import Config from "./pages/config";
import Equilibre from "./pages/equilibre";
import Depense from "./pages/depense";
import Login from "./pages/login";
import Register from "./pages/register";
import CreateTenant from "./pages/createTenant";

function App() {
  let test = true;
  return (
    <ContextProvider>
      <BrowserRouter>
        <div className="App">
          <Header />
          <Routes>
            <Route path="/login" element={<Login />} />
            <Route path="/createTenant" element={<CreateTenant />} />
            <Route path="/register" element={<Register />} />
            <Route path="/config" element={<Config />} />
            <Route path="/depense" element={<Depense />} />
            <Route path="/equilibre" element={<Equilibre />} />
          </Routes>
        </div>
      </BrowserRouter>
    </ContextProvider>
  );
}


export default App;
