import React from "react";
import { Routes, Route, BrowserRouter } from "react-router-dom";
import { ContextProvider } from "./context/context";
import Page1 from "./pages/page1";
import Page2 from "./pages/page2";

function App() {
  return (
    <ContextProvider>
      <BrowserRouter>
        <div className="App">
          <p>projet start</p>
          <Routes></Routes>
        </div>
      </BrowserRouter>
    </ContextProvider>
  );
}

export default App;
