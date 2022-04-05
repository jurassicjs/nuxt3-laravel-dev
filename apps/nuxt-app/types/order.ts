export interface IOrderResponse {
  order?:       IOrder;
  actionLinks?: IActionLink[];
}

export interface IActionLink {
  payLink: ILinkMethod;
  cancelLink: ILinkMethod;
}

export interface ILinkMethod {
  url:    string;
  method: string;
  action: string;
}

export interface IOrder {
  id:     number;
  status: string;
  price:  number;
}
