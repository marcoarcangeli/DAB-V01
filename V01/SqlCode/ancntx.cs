using System;
using System.Collections;
using System.Collections.Generic;
using System.Text;
namespace Dadb
{
    #region Ancntx
    public class Ancntx
    {
        #region Member Variables
        protected int _IdAnCntx;
        protected int _IdAn;
        protected int _IdCntx;
        protected int _IdSplitType;
        protected string _nam;
        protected string _descr;
        protected string _fileRefTrainDat;
        protected string _fileRefTestDat;
        #endregion
        #region Constructors
        public Ancntx() { }
        public Ancntx(int IdAn, int IdCntx, int IdSplitType, string nam, string descr, string fileRefTrainDat, string fileRefTestDat)
        {
            this._IdAn=IdAn;
            this._IdCntx=IdCntx;
            this._IdSplitType=IdSplitType;
            this._nam=nam;
            this._descr=descr;
            this._fileRefTrainDat=fileRefTrainDat;
            this._fileRefTestDat=fileRefTestDat;
        }
        #endregion
        #region Public Properties
        public virtual int IdAnCntx
        {
            get {return _IdAnCntx;}
            set {_IdAnCntx=value;}
        }
        public virtual int IdAn
        {
            get {return _IdAn;}
            set {_IdAn=value;}
        }
        public virtual int IdCntx
        {
            get {return _IdCntx;}
            set {_IdCntx=value;}
        }
        public virtual int IdSplitType
        {
            get {return _IdSplitType;}
            set {_IdSplitType=value;}
        }
        public virtual string Nam
        {
            get {return _nam;}
            set {_nam=value;}
        }
        public virtual string Descr
        {
            get {return _descr;}
            set {_descr=value;}
        }
        public virtual string FileRefTrainDat
        {
            get {return _fileRefTrainDat;}
            set {_fileRefTrainDat=value;}
        }
        public virtual string FileRefTestDat
        {
            get {return _fileRefTestDat;}
            set {_fileRefTestDat=value;}
        }
        #endregion
    }
    #endregion
}