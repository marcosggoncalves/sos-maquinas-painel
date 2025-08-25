import React, { Component } from 'react';
import { NavigationContainer } from '@react-navigation/native';
import { createStackNavigator } from '@react-navigation/stack';
import { Button  } from 'react-native';

import LoginScreen from '../pages/Login';
import Cadastro from '../pages/Cadastro';
import Editar from '../pages/Editar';
import Grid_categorias from '../pages/Grid_categorias';
import Grid_produtos from '../pages/Grid_produtos';
import Produto_selecionado from '../pages/Produto_selecionado';
import colors from '../styles/colors';
import metrics from '../styles/metrics';

import { AsyncStorage, Alert } from 'react-native';


import Icon from 'react-native-vector-icons/FontAwesome';

const Stack = createStackNavigator();

class Routes extends Component{
  constructor(props){
    super(props);
  }

  render(){
    return (
      <NavigationContainer>
        <Stack.Navigator>

          <Stack.Screen
            name="login"
            component={LoginScreen}
            options={{
              title: 'SOS Máquinas',
              headerTitleAlign: 'center',
              headerLeft: null,
              gesturesEnabled: false,
              headerTitleStyle:{
                fontSize: metrics.titleHeader,
                letterSpacing: metrics.spacingHeader,
                color: colors.fontHeader,
              },

              headerStyle:{
                backgroundColor: colors.primaryColor,
                height: metrics.heightHeader
              }
            }}
          />

          <Stack.Screen
            name="cadastro"
            component={Cadastro}
            options={{
              title: 'Criar uma conta',
              headerTitleAlign: 'center',
              headerTitleStyle:{
                fontSize: metrics.titleHeader,
                color: colors.fontHeader,
              },

              headerStyle:{
                backgroundColor: colors.primaryColor,
                height: metrics.heightHeader
              }
            }}
          />

          <Stack.Screen
            name="editar"
            component={Editar}
            options={({ navigation }) =>({
              title: 'Alterar conta',
              headerTitleAlign: 'center',
              headerRight:() => (
                <Icon onPress={ () =>{
                    AsyncStorage.clear().then(() => {
                       Alert.alert(
                        "Sessão finalizada com sucesso!",
                        "Obrigado por acessar.",
                         [
                          {text: 'OK', onPress: () => {navigation.push('login')}},
                         ]
                      ); 
                    });

                  }} name="external-link" style={{marginRight: 25}} size={25} color="#fff" />
              ),
              headerTitleStyle:{
                fontSize: metrics.titleHeader,
                color: colors.fontHeader,
              },

              headerStyle:{
                backgroundColor: colors.primaryColor,
                height: metrics.heightHeader
              }
            })}
          />

          <Stack.Screen
            name="categorias"
            component={Grid_categorias}

            options={({ navigation }) => ({
              title: 'Categorias',
              headerRight: () => (
                <Icon onPress={() =>{
                     navigation.push('editar')
                  }} name="edit" style={{marginRight: 25}} size={25} color="#fff" />
              ),
              headerTitleAlign: 'center',
              headerTitleStyle:{
                fontSize: metrics.titleHeader,
                color: colors.fontHeader,
              },

              headerStyle:{
                backgroundColor: colors.primaryColor,
                height: metrics.heightHeader
              }
            })}
          />

          <Stack.Screen
            name="produtos"
            component={Grid_produtos}
            options={({ route }) => ({
             title: route.params.categoria,
              headerTitleAlign: 'center',
                headerTitleStyle:{
                  fontSize: 23,
                  color: colors.fontHeader,
                },
                headerStyle:{
                  backgroundColor: colors.primaryColor,
                  height: metrics.heightHeader
                }
            })}
          />

          <Stack.Screen
            name="prod_select"
            component={Produto_selecionado}
             options={({ route }) => ({
             title: route.params.simbolo.titulo,
              headerTitleAlign: 'center',
                headerTitleStyle:{
                  fontSize: 23,
                  color: colors.fontHeader,
                },
                headerStyle:{
                  backgroundColor: colors.primaryColor,
                  height: metrics.heightHeader
                }
            })}
          />

        </Stack.Navigator>
      </NavigationContainer>
    );
  }
}

export default Routes;