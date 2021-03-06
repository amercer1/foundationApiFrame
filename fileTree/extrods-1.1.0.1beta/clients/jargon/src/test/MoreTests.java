import edu.sdsc.grid.io.local.*;
import edu.sdsc.grid.io.srb.*;
import edu.sdsc.grid.io.*;

import java.net.URI;
import java.io.*;



public class MoreTests
{
	/**
	 * Open a connection to the file system.
	 * The filesystem object represents the connection to the filesystem.
	 * Only one filesystem object is needed to access all the files on
	 * that system.
	 */
	GeneralAccount account = null;
	GeneralFileSystem fileSystem = null;


	/**
	 * The GeneralFile class is used in much the same manner as the
	 * java.io.File class. A GeneralFile object can represent
	 * a file or directory.
	 */
	GeneralFile file = null;


	/**
	 * The metadata records list for each file (directory, or other value
	 * the query selected for) is stored in this array.
	 */
	MetaDataRecordList[] rl = null;
  MetaDataCondition[] conditions;
  MetaDataSelect[] selects;
  MetaDataTable metaDataTable;


//----------------------------------------------------------------------
// Constructors
//----------------------------------------------------------------------
	/**
	 * Testing for various small bugs that could possibly occur. Not really
	 * for showing examples of the functionality.
	 */
	public MoreTests( )
		throws Throwable
	{
		this( new String[0] );
	}

	/**
	 * Testing the metaData
	 */
	public MoreTests( GeneralFile file )
		throws Throwable
	{
		if (file != null) {
			this.file = file;
			fileSystem = file.getFileSystem();
			run();
		}
		else {
			String uri[] = { file.toString() };

			new MetaDataTest( uri );
		}
	}

	/**
	 * Testing the metaData
	 */
	public MoreTests( String args[] )
		throws Throwable
	{
		if (args == null) args = new String[0];

System.out.println("\n Connect to the fileSystem.");
		/**
		 * You can query any filesystem object though not all,
		 * such as LocalFileSystem, will return useful results.
		 */
		if (args.length == 1) {
			//url to file
			file = FileFactory.newFile(new URI( args[0] ));
			fileSystem = file.getFileSystem();
		}
		else if (args.length == 0) {
			fileSystem = FileFactory.newFileSystem( new SRBAccount( ) );

			String fileName = "myJARGONMoreTestsFile";
			file = FileFactory.newFile( fileSystem, fileName );
		}
		else {
			throw new IllegalArgumentException(
				"Wrong number of arguments sent to Test.");
		}

		run();
	}


	public void run()
		throws Throwable
	{
		//Make sure file exists
		file.createNewFile();


    if (fileSystem instanceof SRBFileSystem)
    {
      SRBFileSystem srbFileSystem = (SRBFileSystem) fileSystem;

      rl = fileSystem.query( 
        new MetaDataCondition[] { MetaDataSet.newCondition(
            SRBMetaDataSet.USER_NAME, MetaDataCondition.EQUAL, srbFileSystem.getUserName() ) },
        new MetaDataSelect[] { MetaDataSet.newSelection( SRBMetaDataSet.USER_TYPE_NAME ) }
      );
      for (int i=0;i<rl.length;i++) {
        if ( rl[i].getStringValue(0).equals("sysadmin") ) {
          //*******************************
          //Add a DN (must be sysadmin)
          //*******************************		          
          System.out.println("Add a DN for GSI");
          srbFileSystem.srbModifyUser(SRBFile.MDAS_CATALOG, "testuser@sdsc",
            "GSI_AUTH:/C=US/O=UCSD/OU=SDSC/CN=Test User/UID=testuser",
            SRBMetaDataSet.U_INSERT_AUTH_MAP);          
        }
      }



      //*******************************
      // Store new Annotation
      //*******************************
      System.out.println("Add annotation");
      for (int i=0;i<rl.length;i++) {
        rl[i] = new SRBMetaDataRecordList(
          SRBMetaDataSet.getField(SRBMetaDataSet.FILE_ANNOTATION ),  "anno"+i );
        rl[i].addRecord( 
          SRBMetaDataSet.getField(SRBMetaDataSet.FILE_ANNOTATION_POSITION ), i);
        file.modifyMetaData( rl[i] );
        //So the timestamp is different
        Thread.sleep(1000);
      }

      //check if it worked
      conditions = new MetaDataCondition[] { 
        MetaDataSet.newCondition(
          SRBMetaDataSet.FILE_NAME, MetaDataCondition.EQUAL, file.getName() ),
      };

      selects = new MetaDataSelect[] { 
        MetaDataSet.newSelection( SRBMetaDataSet.FILE_ANNOTATION ),
        MetaDataSet.newSelection( SRBMetaDataSet.FILE_ANNOTATION_POSITION ),
        MetaDataSet.newSelection( SRBMetaDataSet.FILE_ANNOTATION_TIMESTAMP )
      };
      rl = fileSystem.query( conditions, selects );
      MetaDataTest.printQueryResults(rl);


      //Remove the first annotation
      rl[0] = new SRBMetaDataRecordList(
        SRBMetaDataSet.getField(SRBMetaDataSet.FILE_ANNOTATION_TIMESTAMP),
        rl[0].getValue(SRBMetaDataSet.FILE_ANNOTATION_TIMESTAMP).toString()
      );
      rl[0].addRecord( 
        SRBMetaDataSet.getField(SRBMetaDataSet.FILE_ANNOTATION ), (String) null);
      file.modifyMetaData( rl[0] );

      //check if it worked
      rl = fileSystem.query( conditions, selects );
      MetaDataTest.printQueryResults( rl );



      //*******************************
      //Do something with a Shadow file
      //*******************************
      System.out.println("Shadow files");
      new ShadowFileTest( file, "shadow" );


      //*******************************
      //create a whole bunch of metadata and test it
      //*******************************
      System.out.println("Create a whole bunch of metadata");
      createTestDefinableMetaData();
      String[][] definableMetaDataValues = new String[3][2];

      definableMetaDataValues[1][0] = "a";
      definableMetaDataValues[1][1] = "1";

      definableMetaDataValues[0][0] = "b";
      definableMetaDataValues[0][1] = "2";

      int[] operators = new int[ definableMetaDataValues.length];
      operators[0] = MetaDataCondition.EQUAL;
      operators[1] = MetaDataCondition.EQUAL;

      metaDataTable =
        new MetaDataTable( operators, definableMetaDataValues );

      conditions = new MetaDataCondition[] {
        MetaDataSet.newCondition( SRBMetaDataSet.DEFINABLE_METADATA_FOR_FILES,
          metaDataTable ),
      };
      selects = new MetaDataSelect[] { 
        MetaDataSet.newSelection( 
          SRBMetaDataSet.DEFINABLE_METADATA_FOR_FILES ), 
      };
      rl  = srbFileSystem.query( conditions, selects, 2);

      System.out.println (rl);
      MetaDataTest.printQueryResults(rl);

      System.out.println(rl);
      MetaDataTest.printQueryResults(rl);
      System.out.println(rl[0].isQueryComplete());
      while (!rl[0].isQueryComplete()) {
        rl = rl[0].getMoreResults(2);
        MetaDataTest.printQueryResults(rl);
      }


      //*******************************
      //try md5 and proxy command
      //*******************************
      System.out.println("md5 and proxy command");
      InputStream proxyRetVal = srbFileSystem.executeProxyCommand( "mdfive",
        ((SRBFile) file).getServerLocalPath(), null, null,
        SRBFileSystem.PORTAL_STD_IN_OUT );

      int result = proxyRetVal.read();
      if (result == -1) {
        //error something probably
      }
      do {
        System.out.print((char)result);
        result = proxyRetVal.read();
      } while (result != -1);


      //*******************************
      //Connect to your extensible schema filesystem
      //*******************************
      System.out.println("extensible schema");
      try {
        //Choose the schema you will use. 
        //Only needs to be done once, or when you change to a different schema
        SRBMetaDataSet.setExtensibleSchema( fileSystem, "mySchema" );

        //Create extensible conditions and selects as normal.
        //Instead of a system metadata attribute use a extensible schema attribute.
        conditions = new MetaDataCondition[] {
          MetaDataSet.newCondition( "myExtensibleAttribute", 
            MetaDataCondition.EQUAL, "127.0.0.1" )
        };

        selects = new MetaDataSelect[] { 
          MetaDataSet.newSelection( "myExtensibleOtherAttribute" ),

          //System metadata conditions and selects can still work along side
          MetaDataSet.newSelection( SRBMetaDataSet.USER_NAME )
        };

        //Send the query as before.
        MetaDataRecordList[] rl = fileSystem.query( conditions, selects );

        MetaDataTest.printQueryResults(rl);
      } catch(Throwable e) {
        //ignore since this won't actually work, since it isn't really set up
      }
      
      //To let the user choose from a list of metadata attributes use:
      MetaDataGroup[] groups = SRBMetaDataSet.getMetaDataGroups(fileSystem);
      MetaDataField[] fields = groups[0].getFields();
    }
	}

  void createTestDefinableMetaData()
    throws IOException
  {    GeneralFile dir;
    if (!file.isDirectory()) {
      dir = FileFactory.newFile( file.getParentFile(), Test.TEST_DIR );
    }
    else {
      dir = file;
    }
    GeneralFile newFile = null, newDir = null;

    String[][] rows = {
      {"a", "1"},
      {"b", "2", "b3"},
      {"c", "3", "c3", "c3"},
      {"d", "4", "d3", "d4", "c3"},
      {"e", "5", "e3", "e4", "e5", "e6"},
      {"f", "6", "f3", "f4", "f5", "f6", "f7"},
      {"g", "7", "g3", "g4", "g5", "g6", "g7", "g8"},
      {"h", "8", "h3", "h4", "h5", "h6", "h7", "h8", "h9"},
      {"i", "9", "i3", "i4", "i5", "i6", "i7", "i8", "i9", "i10"},
    };
    int[] op = {MetaDataCondition.EQUAL};
    String[][] rowOne = {{"test", "metadata"}};
    MetaDataTable table = new MetaDataTable( op, rowOne );

    MetaDataRecordList record;
    for(int i=0;i<11;i++) {
      record = new SRBMetaDataRecordList( MetaDataSet.getField(
      SRBMetaDataSet.DEFINABLE_METADATA_FOR_DIRECTORIES), table );
      newDir = FileFactory.newFile( dir, "dir"+i );
      newDir.mkdirs();
      newDir.modifyMetaData(record);
      record = new SRBMetaDataRecordList( MetaDataSet.getField(
        SRBMetaDataSet.DEFINABLE_METADATA_FOR_FILES), table );
      newFile = FileFactory.newFile( dir, "f"+i );
      newFile.createNewFile();
      newFile.modifyMetaData(record);
      newFile = FileFactory.newFile( newDir, "dirF"+i );
      newFile.createNewFile();
      newFile.modifyMetaData(record);

      table.addRow(rows[i], op[0]);
    }
  }


//----------------------------------------------------------------------
// Methods
//----------------------------------------------------------------------

	/**
	 * Stand alone testing.
	 */
	public static void main(String args[])
	{
		try {
			MoreTests mdt = new MoreTests(args);
    	} catch ( Throwable e ) {
			System.out.println( "\nJava Error Message: "+ e.toString() );
			e.printStackTrace();
    		System.exit(1);
		}

		System.exit(0);
	}
}
