import edu.sdsc.grid.io.srb.SRBAccount;
import edu.sdsc.grid.io.srb.SRBFileSystem;
import edu.sdsc.grid.io.srb.SRBFile;

import edu.sdsc.grid.io.srb.*;
import edu.sdsc.grid.io.*;


import java.io.*;
import java.net.URI;
import java.util.*;


public class GSITest
{
//----------------------------------------------------------------------
// Main
//----------------------------------------------------------------------
	/**
	 * Testing SRB functions
	 */
	public static void main(String args[])
	{
		SRBAccount srbAccount = null;
		SRBFileSystem srbFileSystem = null;

		SRBFile srbFile = null;



		/**
		 * If error occurs exit with this variable;
		 */
		int err = 0;

		try{
			if (args.length >= 1) {        
        if ((args.length > 1) && (args[0].equals("-uri")))
        {          
          //set the password option to GSI_AUTH
          srbAccount.setOptions( SRBAccount.GSI_AUTH );

          //give the file path of your proxy file instead of the a password
          srbAccount.setPassword( args[2] );

          if (args.length > 3) {
            String certificatesAuthorities = "";
            for (int i=3;i<args.length;i++) {
              certificatesAuthorities += args[i];
              if (i < args.length-1)
                certificatesAuthorities+=",";
            }

            //If the CA locations are not defined in your cog.properties file:
            srbAccount.setCertificateAuthority(	certificatesAuthorities );
          }
        }
        else {
  				//uses the ~/.srb/MdasEnv user info file
    			srbAccount = new SRBAccount( );

//**********************************************************************
//For GSI authentication:
//**********************************************************************
          //set the password option to GSI_AUTH
          srbAccount.setOptions( SRBAccount.GSI_AUTH );

          //give the file path of your proxy file instead of the a password
          srbAccount.setPassword( args[0] );

          if (args.length > 1) {
            String certificatesAuthorities = "";
            for (int i=1;i<args.length;i++) {
              certificatesAuthorities += args[i];
              if (i < args.length-1)
                certificatesAuthorities+=",";
            }

            //If the CA locations are not defined in your cog.properties file:
            srbAccount.setCertificateAuthority(	certificatesAuthorities );
          }

//**********************************************************************
//
//**********************************************************************
          
          
        }
			}
			else if (args.length == 0) {
				//The GSI setting that work for me:

				//uses the ~/.srb/MdasEnv user info file
				srbAccount = new SRBAccount( );

				//set the password option to GSI_AUTH
				srbAccount.setOptions( SRBAccount.GSI_AUTH );

				//give the file path of your proxy file instead of the a password
				srbAccount.setPassword( "i:\\x509up_u28227" );

				//If the CA locations are not defined in your cog.properties file.
        //The signing polices should also be in the same directory.
				srbAccount.setCertificateAuthority(
					"/etc/grid-security/certificates/b89793e4.0, "+
					"/etc/grid-security/certificates/3deda549.0, "+
					"/etc/grid-security/certificates/42864e48.0" );
			}
			else {
				throw new IllegalArgumentException(
					"Wrong number of arguments sent to Test." );
			}

/*
      Object cred = GSIAuth.getCredential(srbAccount);
      srbAccount = new SRBAccount( srbAccount.getHost(),srbAccount.getPort(),cred);
      
System.out.println(srbAccount+ " "+cred+" "+srbAccount.getGSSCredential());
*/			srbFileSystem = new SRBFileSystem( srbAccount );

			srbFile = new SRBFile( srbFileSystem, "/home" );
			System.out.println( "True if connected: "+ srbFile.exists() );
		}
		catch ( Throwable e ) {
			e.printStackTrace();

			Throwable chain = e.getCause();
			while (chain != null) {
				chain.printStackTrace();
				chain = chain.getCause();
			}
			err = 1;
		}


		System.exit(err);
	}
}
