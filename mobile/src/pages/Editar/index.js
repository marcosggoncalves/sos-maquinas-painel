import React, { Component } from 'react';
import { Text, View, TouchableOpacity, TextInput, Alert, ScrollView, AsyncStorage } from 'react-native';
import styles from './style';
import api from '../../axios';
import qs  from 'qs';

export default class EditPage extends React.Component {
 constructor(props) {
  
  super(props)
    
  this.state = {
    cadastro:{
      id: null,
      email:null,
      cpf:null,
      empresa:null,
      marca_veiculo:null,
      tipo_veiculo:null,
      nome:null,
      telefone:null,
    },
    errors: {
      email:null,
      cpf:null,
      empresa:null,
      marca_veiculo:null,
      tipo_veiculo:null,
      nome:null,
      telefone:null
    }
  }
}

componentDidMount() {
  const { navigation } = this.props;

  AsyncStorage.getItem('usuario').then(usuario => {

     const logado = JSON.parse(usuario);

     this.setState(prevState => {

      prevState.cadastro.id = logado.id;
      prevState.cadastro.email = logado.email;
      prevState.cadastro.cpf = logado.cpf;
      prevState.cadastro.empresa = logado.empresa;
      prevState.cadastro.marca_veiculo = logado.marca_veiculo;
      prevState.cadastro.tipo_veiculo = logado.tipo_veiculo;
      prevState.cadastro.nome = logado.nome;
      prevState.cadastro.telefone = logado.telefone;
     
      return prevState;
    })
  })
}

alterar() {
  const { navigation } = this.props;

  api.post(`/editar-cadastro/${this.state.cadastro.id}`,  qs.stringify(this.state.cadastro)).then((res) => {
    if(res.data.status){
      Alert.alert(
        "Alteração no cadastro",
        res.data.message,
         [
          {text: 'OK', onPress: () => {
            navigation.push('categorias')
          }},
         ]
      ); 

      AsyncStorage.setItem('usuario', JSON.stringify(res.data.usuario));
    }else{ 
      this.setState({errors : res.data.validate});
    }
  }).catch(err => {
    Alert.alert(
      "Atenção",
      "Ocorreu um erro ao tentar alterar cadastro, tente novamente!",
    );
  });
}

verificarInputs(campo, value){
  this.setState(prevState => {
    prevState.cadastro[campo] = value;
    prevState.errors[campo] = null;

    return prevState;
  })
}

render() {

    const {
      email,
      cpf,
      empresa,
      marca_veiculo,
      tipo_veiculo,
      nome,
      telefone,
    } = this.state.cadastro;


    const errors = this.state.errors;

    return(
      <ScrollView>

        <View style = {styles.form}>

          <Text style= {styles.textLogin}>Seja bem vindo {nome}</Text>

          <TextInput
            style = {styles.input}
            placeholder="Digite seu nome completo"
            value={nome}
            onChangeText={nome => this.verificarInputs('nome', nome)}
          />

          <Text style={styles.textError}>{errors.nome}</Text> 

          <TextInput
            style = {[styles.input, {marginTop: 10}]}
            placeholder="Digite seu CPF"
            keyboardType = 'numeric'
            value={cpf}
            onChangeText={cpf =>this.verificarInputs('cpf', cpf)}
          />

          <Text style={styles.textError}>{errors.cpf}</Text> 

          <TextInput
            style = {[styles.input, {marginTop: 10}]}
            placeholder="Digite seu telefone"
            keyboardType = 'numeric'
            value={telefone}
            onChangeText={telefone => this.verificarInputs('telefone', telefone)}
          />

          <Text style={styles.textError}>{errors.telefone}</Text> 

          <TextInput
            style = {[styles.input, {marginTop: 10}]}
            placeholder="Digite seu Email"
            value={email}
            onChangeText={email => this.verificarInputs('email', email)}
          />

          <Text style={styles.textError}>{errors.email}</Text> 

          <TextInput
            style = {[styles.input, {marginTop: 10}]}
            placeholder="Digite o nome da sua empresa"
            value={empresa}
            onChangeText={empresa => this.verificarInputs('empresa', empresa)}
          />

          <Text style={styles.textError}>{errors.empresa}</Text>

          <TextInput
            style = {[styles.input, {marginTop: 10}]}
            placeholder="Digite o tipo do veículo"
            value={tipo_veiculo}
            onChangeText={tipo_veiculo =>this.verificarInputs('tipo_veiculo', tipo_veiculo)}
          />

          <Text style={styles.textError}>{errors.tipo_veiculo}</Text>
          
          <TextInput
            style = {[styles.input, {marginTop: 10}]}
            placeholder="Digite a marca do veículo"
            value={marca_veiculo}
            onChangeText={marca_veiculo => this.verificarInputs('marca_veiculo', marca_veiculo)}
          />

          <Text style={styles.textError}>{errors.marca_veiculo}</Text>
            
          <View style={styles.containerButton}>

            <TouchableOpacity 
              style={styles.button}
              onPress={()=>{this.alterar()}}>

              <Text style = {styles.textButton}>
                Confirmar
              </Text>
            </TouchableOpacity>

          </View> 
        </View>
      </ScrollView>
    );
  }
}
