import React, {Component} from 'react';
import { TextInput, View, ScrollView, Text, RefreshControl} from 'react-native';
import styles from './style';
import Categoria from '../../components/Categoria';
import colors from '../../styles/colors';
import { Entypo } from '@expo/vector-icons';
import Carousel from '../../components/Carousel/Carousel';
import {findAll} from '../../services/index';
import sincronizar from '../../sincronizar';

export default class Grid_categorias extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      categorias: [],
      refreshing: false
    };
  }

  _onRefresh = ()=>{
    sincronizar();

    this.setState({refreshing: true});
    
    setTimeout(()=>{
       this.setState({refreshing: false});  
       this.getCategorias();
    },2000);

     clearTimeout();
  }

  async filterCategorias(search){ 
    let getCategoriasFilter = await findAll(`categorias where categoria like '%${search}%'`);

    this.setState(prevState => {
      prevState.categorias  = getCategoriasFilter._array;
      return prevState;
    });
  }

  async getCategorias(){
    let getCategorias = await findAll('categorias');

    this.setState(prevState => {
      prevState.categorias  = getCategorias._array;
      return prevState;
    });
  }

  componentDidMount(){
    this.getCategorias();
  }

  render(){
    const {categorias, filter, refreshing} = this.state;
    const { navigation } = this.props;

    return(
      <ScrollView >
        <View style ={styles.containerSearch}>
          <View style ={styles.boxPesquisa}>
            <Entypo style={styles.iconPesquisa} name="magnifying-glass" size={18} color={colors.preto07} />
            <TextInput 
                style= {styles.textoInput} 
                placeholder="Pesquisar categoria...."
                 onChangeText={query => {
                  this.filterCategorias(query)
                }}
              />
          </View>
        </View>

        <View style = {styles.containerSections} >
          <View style ={styles.containerGrid3x3}>
            <ScrollView contentContainerStyle ={styles.contentScroll} refreshControl={
                <RefreshControl
                  refreshing={refreshing}
                  onRefresh={this._onRefresh}
                />
              }>
              { 
                  categorias.map(categoria =>
                    <Categoria
                      imgLink={categoria.imagem}
                      legenda={categoria.categoria}
                      key={categoria.id}
                      func={() => {
                        navigation.navigate('produtos',
                          { id: categoria.id, categoria: categoria.categoria },
                        );
                      }}
                    />
                  )
              }
            </ScrollView>
          </View>
          <View style = {styles.containerPublicidade}>
           <Carousel />
          </View>
        </View>
      </ScrollView>
    );
  };
} 
