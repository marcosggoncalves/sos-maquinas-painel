import { StyleSheet, Dimensions } from 'react-native';
import colors from '../../styles/colors';
import metrics from '../../styles/metrics';

const {width, height} = Dimensions.get('window');

const styles = StyleSheet.create({
  textPubli: {
    textTransform: 'uppercase',
    color: colors.pretoFosco,
    fontSize: metrics.fontButton,
    fontWeight: 'bold'
  }
});

export default styles;