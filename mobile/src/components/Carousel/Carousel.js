import * as React from 'react';

import {findAll} from '../../services/index';

import styles from './style';

import {
  View,
  Linking,
  Dimensions,
  Text
} from 'react-native';

import { SliderBox } from "react-native-image-slider-box";

const {width} = Dimensions.get('window');

export default class Carousel extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      position: 0,
      publicidades: [],
      imagens:[]
    };
  }

   async getPublicidades() {
    let getPublicidades = await findAll('publicidades');

    let imagens = [];

    getPublicidades._array.forEach(item=>{
      imagens.push('http://www.tegy.com.br/public/' + item.imagem);
    });

    this.setState(prevState => {
      prevState.publicidades = getPublicidades._array;
      prevState.imagens =  imagens;
      return prevState;
    });
  }

  componentDidMount(){
    this.getPublicidades();
  }

  componentDidUpdate() {
    this.getPublicidades();
  }

  render() {

    const {imagens} = this.state;

    return imagens.length > 0 ? (
      <View>
        <SliderBox
          images={this.state.imagens}
          sliderBoxHeight={140}
          onCurrentImagePressed={index =>  Linking.openURL(this.state.publicidades[index].link)}
          dotColor="#fff"
          inactiveDotColor="#303F9F"
          autoplay
          circleLoop
          parentWidth={width - 20}
          resizeMethod={'resize'}
          resizeMode={'cover'}
        />  
      </View>
    ) : (
      <View>
        <View>
          <Text style = {styles.textPubli}>Publicidades</Text>
        </View>
      </View>
    );
  }
}