import React, {Component} from 'react';
import { StatusBar } from 'react-native';
import Routes from './src/config/routes.js';
import DatabaseInit from './src/database/database';

export default class App extends Component{
  constructor(props) {
      super(props);
      new DatabaseInit
  }

  render(){
    return (
      <>
        <StatusBar backgroundColor="#303F9F" />
        <Routes />
      </>
    );
  }
}
