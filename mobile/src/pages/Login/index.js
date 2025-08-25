import React, { Component }  from 'react';
import { Text, View, TextInput, TouchableOpacity, AsyncStorage, Alert } from 'react-native';
import styles from './style';
import colors from '../../styles/colors';
import api from '../../axios';
import qs  from 'qs';

import {atualizar} from '../../services/index';

export default class LoginScreen extends React.Component {
  constructor(props) {
    super(props);
      
    this.state = {
      login:{
        cpf: null
      },
      errors:{
        cpf: null
      },
    }
  }

  verificarInputs(campo, value){
    this.setState(prevState => {
      prevState.login[campo] = value.replace(/[^0-9]/g, '');
      prevState.errors[campo] = null;

      return prevState;
    })
  }

  entrar() {
    const  {cpf} = this.state.login;
    const { navigation } = this.props;

    api.post('/logar', qs.stringify({cpf: cpf})).then((result) => {
      if(result.data.status){

        AsyncStorage.setItem('usuario', JSON.stringify(result.data.usuario));

        api.get('/data').then((data) =>{
          
          AsyncStorage.setItem('gravado', JSON.stringify(data.data.success));

          atualizar(data.data.publicidades);
          atualizar(data.data.categorias);
          atualizar(data.data.simbolos);
          atualizar(data.data.simbolosItens);

          navigation.navigate('categorias');

          this.setState({cpf: null});

        }).catch(err => {
          Alert.alert(
            "Atenção",
            "Ocorreu um erro ao tentar sincronizar dados, tente novamente!",
          );
        });

      }else{ 
        if(result.data && result.data.validate){
           this.setState({errors : result.data.validate});
        }else{
           Alert.alert(
            "Não foi possivel realizar login",
            result.data.message
          ); 
        }
      }
    }).catch(err => {
      Alert.alert(
        "Atenção",
        "Ocorreu um erro ao tentar efetuar login, tente novamente!",
      );
    });
  }

  verifyLogin(){
    const { navigation } = this.props;

    AsyncStorage.getItem('gravado').then(gravado => {
      if (gravado) {
        navigation.navigate('categorias');
      }
    })
  }

  componentDidUpdate(){
    this.verifyLogin();
  }

  componentDidMount() {
    this.verifyLogin();
  }

  render(){

    const { navigation } = this.props;
    const {cpf} = this.state.login;
    const errors = this.state.errors;

    return(
      <View style = {styles.container}>

        <View style = {styles.form}>

          <Text style= {styles.textLogin}>Login</Text>

          <TextInput
            keyboardType = 'numeric'
            style = {[styles.input, {marginTop: 20}]}
            placeholder="Digite seu CPF"
            value={cpf}
            onChangeText={cpf => this.verificarInputs('cpf', cpf)}
          />

          <Text style={styles.textError}>{errors.cpf}</Text> 
            
          <View style={styles.containerButton}>

            <TouchableOpacity
              style={styles.button}
              onPress={() =>{
                this.entrar()
              }}>

              <Text style = {styles.textButton}>
                ENTRAR
              </Text>
            </TouchableOpacity>

            <TouchableOpacity
              style = {[styles.button, {backgroundColor: colors.branco}]}
              onPress = {() => {
                navigation.push('cadastro');
              }}>

              <Text
                style = {[styles.textButton, {color: "#adadad", fontWeight: 'bold'}]}>
                Cadastrar
              </Text>
            </TouchableOpacity>

          </View> 
        </View>
      </View>
    )
  }
}
