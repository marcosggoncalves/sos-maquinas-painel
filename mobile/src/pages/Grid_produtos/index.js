import React,{Component} from 'react';
import { View, ScrollView, Text, AsyncStorage,TextInput, RefreshControl} from 'react-native';
import { Entypo } from '@expo/vector-icons';
import styles from './style';
import Produto from '../../components/Produto';
import colors from '../../styles/colors';
import Carousel from '../../components/Carousel/Carousel';
import {findAll} from '../../services/index';
import sincronizar from '../../sincronizar';

export default class Grid_produtos extends React.Component {

  constructor(props) {
    super(props)
    this.state = {
      simbolos: [],
     
    };
  }

  _onRefresh = ()=>{
    sincronizar();
    
    this.setState({refreshing: true});

    setTimeout(()=>{
       this.setState({refreshing: false});  
       this.getSimbolos();
    },2000)

    clearTimeout();
  }

  async filterSimbolos(search){ 
    let getFilterSimbolo = await findAll(`categorias_simbolos where descricao like '%${search}%'`);

    this.setState(prevState => {
      prevState.simbolos  = getFilterSimbolo._array;
      return prevState;
    });
  }

  async getSimbolos(){
    const { id } = this.props.route.params;
    const getSimbolos = await findAll(`categorias_simbolos where categoria_id = ${id}`);
    this.setState({simbolos:getSimbolos._array});
  }

  componentDidMount(){
    this.getSimbolos();
  }

  render(){
    const {simbolos, refreshing} = this.state;
    const { navigation } = this.props;

    return (
       <ScrollView>
        <View style ={styles.containerSearch}>
          <View style ={styles.boxPesquisa}>
            <Entypo style={styles.iconPesquisa} name="magnifying-glass" size={18} color={colors.preto07} />
            <TextInput 
                style= {styles.textoInput} 
                placeholder="Pesquisar Simbolo...."
                onChangeText={query => {
                  this.filterSimbolos(query)
                }}
              />
          </View>
        </View>
        <View style ={styles.container}>
          
          <View style = {styles.containerSections}>
            <View style ={styles.containerGrid3x3}>

              <ScrollView contentContainerStyle ={styles.contentScroll} 
                refreshControl={
                  <RefreshControl
                    refreshing={refreshing}
                    onRefresh={this._onRefresh}/>}>
                { 
                    simbolos.map(simbolo =>
                      <Produto
                        legenda={simbolo.titulo}
                        id={simbolo.id}
                        imgLink={simbolo.imagem}
                        func= {() => { navigation.navigate('prod_select',  { simbolo: simbolo })}}
                      />
                    )
                }
              </ScrollView>
            </View>
            
            <View style = {styles.containerPublicidade}>
              <Carousel />
            </View>
          </View>
        </View>
      </ScrollView>
    );
   }
}