import React from 'react';
// import logo from './logo.svg';
import './App.css';
import Search from './components/Search'


function App() {
  return (
    <div className="App">
      <header className="App-header">
        {/*<img src={logo} className="App-logo" alt="logo" />*/}
        <p>
          Edit <code>src/App.js</code> and save to reload.
        </p>
      </header>

      <Search evidenceFileName={'left111'}/>

        <ul>
            <li>one223</li>
            <li>two22</li>
            <li>three22</li>
        </ul>

        <h1>Hello CodeSandbox</h1>
        <h2>Start editing to see some magic happen!</h2>
    </div>
  );
}

export default App;
