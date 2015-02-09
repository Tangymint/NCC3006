/*===============================================================*
 *  File: SWP.java                                               *
 *                                                               *
 *  This class implements the sliding window protocol            *
 *  Used by VMach class					         *
 *  Uses the following classes: SWE, Packet, PFrame, PEvent,     *
 *                                                               *
 *  Author: Professor SUN Chengzheng                             *
 *          School of Computer Engineering                       *
 *          Nanyang Technological University                     *
 *          Singapore 639798                                     *
 *===============================================================*/

public class SWP {

/*========================================================================*
 the following are provided, do not change them!!
 *========================================================================*/
   //the following are protocol constants.
   public static final int MAX_SEQ = 7; 
   public static final int NR_BUFS = (MAX_SEQ + 1)/2;

   // the following are protocol variables
   private int oldest_frame = 0;
   private PEvent event = new PEvent();  
   private Packet out_buf[] = new Packet[NR_BUFS];

   //the following are used for simulation purpose only
   private SWE swe = null;
   private String sid = null;  

   //Constructor
   public SWP(SWE sw, String s){
      swe = sw;
      sid = s;
   }

   //the following methods are all protocol related
   private void init(){
      for (int i = 0; i < NR_BUFS; i++){
        out_buf[i] = new Packet();
      }
   }

   private void wait_for_event(PEvent e){
      swe.wait_for_event(e); //may be blocked
      oldest_frame = e.seq;  //set timeout frame seq
   }

   private void enable_network_layer(int nr_of_bufs) {
      //network layer is permitted to send if credit is available
	    swe.grant_credit(nr_of_bufs);
   }

   private void from_network_layer(Packet p) {
      swe.from_network_layer(p);
   }

   private void to_network_layer(Packet packet) {
	    swe.to_network_layer(packet);
   }

   private void to_physical_layer(PFrame fm)  {
      System.out.println("SWP: Sending frame: seq = " + fm.seq + 
			    " ack = " + fm.ack + " kind = " + 
			    PFrame.KIND[fm.kind] + " info = " + fm.info.data );
      System.out.flush();
      swe.to_physical_layer(fm);
   }

   private void from_physical_layer(PFrame fm) {
      PFrame fm1 = swe.from_physical_layer(); 
    	fm.kind = fm1.kind;
    	fm.seq = fm1.seq; 
    	fm.ack = fm1.ack;
    	fm.info = fm1.info;
   }


/*===========================================================================*
 	implement your Protocol Variables and Methods below: 
 *==========================================================================*/

private boolean no_nak = true;

static boolean between(int a, int b, int c){
  /* Same as between in protocol5, but shorter and more obscure. */
  return ((a <= b) && (b < c)) || ((c < a) && (a <= b)) || ((b < c) && (c < a)); 
}
   
static void send_frame(PFrame fk, int frame_nr, int frame_expected, Packet buffer[]){
/* Construct and send a data, ack, or nak frame. */
  PFrame s;                        /* scratch variable */
  s.kind = fk;                    /* kind == data, ack, or nak */
  if (fk == data){
    s.info = buffer[frame_nr % NR_BUFS];
  } 
  s.seq = frame_nr; /* only meaningful for data frames */ 
  s.ack = (frame_expected + MAX_SEQ) % (MAX_SEQ + 1);
  if (fk == nak) {
    no nak = false;               /* one nak per frame, please */
  }
  to_physical_layer(s);           /* transmit the frame */
  if (fk == data){
    start_timer(frame_nr % NR_BUFS);
  }
  stop_ack_timer();
}
   public void protocol6() {

      int ack_expected;           // Lower edge of sender's window
      int next_frame_to_send;     // Upper edge of sender's window
      int frame_expected;         // Lower edge of receivers's window
      int too_far;                // Upper edge of receivers's window

      int i;                      // Index into buffer pool
      PFrame r;                   // Scratch variable
      Packet in_buf[] = new Packet[NR_BUFS];  // Buffers for inbound stream
      boolean arrived[NR_BUFS] = new boolean[NR_BUFS]; // inbound bit map
      // int nbuffered;               // How many output buffers currently used 
      int credit = 1;


      enable_network_layer(credit);
      init();         
      ack_expected = 0;   
      next_frame_to_send = 0;
      frame_expected = 0;
      too_far = NR_BUFS;
      // nbuffered = 0;
      
      for (i = 0; i < NR_BUFS; i++){
        arrived[i] = false;
      }

    	while(true) {
        wait_for_event(event);
    	  switch(event.type) {
          case (PEvent.NETWORK_LAYER_READY):
                                            from_network_layer(out_buf[next_frame_to_send % NR_BUFS]);
                                            send_frame(data, next_frame_to_send, frame_expected, out_buf);
                                            inc(next_frame_to_send);
                                            next_frame_to_send
                                            break; 
  	      case (PEvent.FRAME_ARRIVAL ):
                                        from_physical_layer(r);
                                        if (r.kind == data){
                                          // An undamaged frame has arrived
                                          if((r.seq != frame_expected) && no_nak){
                                            send_frame(nak, 0, frame_expected, out_buf);
                                          }
                                          else{
                                            start_ack_timer();
                                          }
                                          if(between(frame_expected, r.seq, too_far) && (arrived[r.seq % NR_BUFS] == false)){
                                            arrived[r.seq % NR_BUFS] = true;      /* mark buffer as full */
                                            in_buf[r.seq % NR_BUFS] = r.info;     /* insert data into buffer */ 
                                            while (arrived[frame_expected % NR_BUFS]) {
                                              /* Pass frames and advance window. */
                                              to_network_layer(in_buf[frame_expected % NR_BUFS]); 
                                              no_nak = true;
                                              /*Frames may be accepted in any order*/
                                              arrived[frame_expected % NR BUFS] = false;
  ￼￼￼￼￼￼￼￼￼￼￼￼￼￼￼￼￼￼￼￼￼￼￼                     inc(frame_expected); inc(too far);
                                              start_ack_timer();
                                            }
                                          }
                                        }

                                        if((r.kind==nak) && between(ack_expected,(r.ack+1)%(MAX_SEQ+1),next_frame_to_send)){
                                          send_frame(data, (r.ack+1) % (MAX_SEQ + 1), frame_expected, out_buf);
                                        } 
                                          while (between(ack_expected, r.ack, next_frame_to_send)) {
                                          // nbuffered = nbuffered − 1; /* handle piggybacked ack */
                                          stop_timer(ack_expected % NR_BUFS); /* frame arrived intact */
                                          inc(ack_expected); /* advance lower edge of sender’s window */
                                        }
                                        break;	   
          case (PEvent.CKSUM_ERR): 
                                  if (no_nak){
                                    send_frame(nak, 0, frame_expected, out_buf); /* damaged frame */ 
                                  } 
        	                        break;  
          case (PEvent.TIMEOUT): 
                                  send_frame(data, oldest_frame, frame_expected, out_buf); /* we timed out */
  	                              break; 
  	      case (PEvent.ACK_TIMEOUT): 
                                  send_frame(ack,0,frame_expected, out_buf); /* ack timer expired; send ack */
                                  break; 
          default: 
    		   
          System.out.println("SWP: undefined event type = " + event.type); 
    		  System.out.flush();
    	  }
      }      
  }

 /* Note: when start_timer() and stop_timer() are called, 
    the "seq" parameter must be the sequence number, rather 
    than the index of the timer array, 
    of the frame associated with this timer, 
   */
 
   private void start_timer(int seq) {
     
   }

   private void stop_timer(int seq) {

   }

   private void start_ack_timer( ) {
      
   }

   private void stop_ack_timer() {
     
   }

}//End of class

/* Note: In class SWE, the following two public methods are available:
   . generate_acktimeout_event() and
   . generate_timeout_event(seqnr).

   To call these two methods (for implementing timers),
   the "swe" object should be referred as follows:
     swe.generate_acktimeout_event(), or
     swe.generate_timeout_event(seqnr).
*/


